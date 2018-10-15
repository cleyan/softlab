<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="207" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="pacientesSearch" wizardCaption="Buscar Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="listPacientes.ccp" PathID="pacientesSearch">
			<Components>
				<TextBox id="209" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_rut_ficha" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" visible="Yes" PathID="pacientesSearchs_rut_ficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="211" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="pacientesSearchs_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="212" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="pacientesSearchs_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="208" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="pacientesSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="204" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="pacientes" dataSource="pacientes" pageSizeLimit="100" wizardCaption="Lista de Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nombres, apellidos, rut" PathID="pacientes">
			<Components>
				<Label id="213" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="pacientes_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="214"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="219" visible="True" name="Sorter_rut" column="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="rut" PathID="pacientesSorter_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="220" visible="True" name="Sorter_ficha" column="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="ficha" PathID="pacientesSorter_ficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="221" visible="True" name="Sorter_nombres" column="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nombres" PathID="pacientesSorter_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="222" visible="True" name="Sorter_apellidos" column="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="apellidos" PathID="pacientesSorter_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="223" visible="True" name="Sorter_fono" column="fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fono" PathID="pacientesSorter_fono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="224" visible="True" name="Sorter_celular" column="celular" wizardCaption="Celular" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="celular" PathID="pacientesSorter_celular">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="225" visible="True" name="Sorter_email" column="email" wizardCaption="Email" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="email" PathID="pacientesSorter_email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="234" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_pacientes.ccp" visible="Yes" PathID="pacientesImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="237" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="235" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="Inline" wizardThemeType="File" hrefSource="detalle_pago_peticiones.ccp" visible="Yes" PathID="pacientesImageLink2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="238" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="236" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink3" wizardTheme="Inline" wizardThemeType="File" hrefSource="stat_historiapaciente.ccp" visible="Yes" PathID="pacientesImageLink3">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="239" sourceType="DataField" name="paciente_id" source="paciente_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="226" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="227" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="228" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="229" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="230" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="fono" fieldSource="fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="231" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="celular" fieldSource="celular" wizardCaption="Celular" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="232" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="email" fieldSource="email" wizardCaption="Email" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="233" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="pacientesNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="215" conditionType="Parameter" useIsNull="False" field="rut" parameterSource="s_rut_ficha" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="216" conditionType="Parameter" useIsNull="False" field="ficha" parameterSource="s_rut_ficha" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1"/>
				<TableParameter id="217" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="218" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellidos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="205" tableName="pacientes" posWidth="160" posHeight="366" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="206" tableName="pacientes" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<ImageLink id="175" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="addPaciente" wizardTheme="InLine" wizardThemeType="File" hrefSource="add_pacientes.ccp" visible="Yes" PathID="addPaciente">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="176" sourceType="Expression" name="paciente_id" source="&quot;&quot;"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="203" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="InLine" wizardThemeType="File" hrefSource="menu_principal.ccp" visible="Yes" PathID="ImageLink1">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="listPacientes.php" comment="//" codePage="utf-8" forShow="True" url="listPacientes.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="listPacientes_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="240"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
