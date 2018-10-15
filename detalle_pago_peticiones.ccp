<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="139" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_estados_pagosSearch" wizardCaption="Buscar Peticiones, Estados Pagos, Pacientes, Previsiones, Procedencias, Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="detalle_pago_peticiones.ccp" PathID="peticiones_estados_pagosSearch">
			<Components>
				<TextBox id="171" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="peticiones_estados_pagosSearchs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="145" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_ini" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" visible="Yes" PathID="peticiones_estados_pagosSearchs_fecha_ini">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="179" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha_fin" wizardTheme="Inline" wizardThemeType="File" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" visible="Yes" PathID="peticiones_estados_pagosSearchs_fecha_fin">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="143" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" visible="Yes" PathID="peticiones_estados_pagosSearchs_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="141" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="peticiones_estados_pagosSearchs_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="142" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="peticiones_estados_pagosSearchs_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="144" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_estado_pago_id" wizardCaption="Estado Pago Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="estados_pagos" boundColumn="estado_pago_id" textColumn="nom_estado_pago" visible="Yes" PathID="peticiones_estados_pagosSearchs_estado_pago_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="147" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_procedencia_id" wizardCaption="Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" defaultValue="GetUserProcedenciaID()" orderBy="nom_procedencia" activeCollection="TableParameters" activeTableType="dataSource" visible="Yes" PathID="peticiones_estados_pagosSearchs_procedencia_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="175" conditionType="Parameter" useIsNull="False" field="procedencia_id" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="GetUserProcedenciaID()" orderNumber="1"/>
						<TableParameter id="176" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; . CCGetGroupID() . &quot; &gt; 4" orderNumber="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="140" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_estados_pagosSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="191"/>
					</Actions>
				</Event>
			</Events>
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
		<Record id="181" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="pacientes" dataSource="pacientes" errorSummator="Error" wizardCaption="Ver Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="detalle_pago_peticiones.ccp" PathID="pacientes">
			<Components>
				<Label id="185" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" required="False" caption="Nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="186" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" required="False" caption="Apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="183" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" required="False" caption="Rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="184" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" required="False" caption="Ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="187" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="fono" fieldSource="fono" required="False" caption="Fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="188" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="celular" fieldSource="celular" required="False" caption="Celular" wizardCaption="Celular" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="189" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="email" wizardTheme="Inline" wizardThemeType="File" fieldSource="email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="190"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="182" conditionType="Parameter" useIsNull="False" field="paciente_id" parameterSource="paciente_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
		<Grid id="119" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="peticiones_estados_pagos" dataSource="peticiones, estados_pagos, pacientes, previsiones, procedencias, usuarios" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Estados Pagos, Pacientes, Previsiones, Procedencias, Usuarios " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" orderBy="peticion_id" PathID="peticiones_estados_pagos">
			<Components>
				<Label id="148" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="peticiones_estados_pagos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="149"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="156" visible="True" name="Sorter_peticion_id" column="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="peticion_id" PathID="peticiones_estados_pagosSorter_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="157" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="peticiones_estados_pagosSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="158" visible="True" name="Sorter_nombres" column="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nombres" PathID="peticiones_estados_pagosSorter_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="159" visible="True" name="Sorter_apellidos" column="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="apellidos" PathID="peticiones_estados_pagosSorter_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="160" visible="True" name="Sorter_nom_procedencia" column="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_procedencia" PathID="peticiones_estados_pagosSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="161" visible="True" name="Sorter_nom_estado_pago" column="nom_estado_pago" wizardCaption="Nom Estado Pago" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado_pago" PathID="peticiones_estados_pagosSorter_nom_estado_pago">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="162" visible="True" name="Sorter_nom_usuario" column="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_usuario" PathID="peticiones_estados_pagosSorter_nom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="173" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="list_pago_peticion.ccp" visible="Yes" PathID="peticiones_estados_pagosImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="174" sourceType="DataField" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="163" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="164" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="165" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="166" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="167" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="168" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado_pago" fieldSource="nom_estado_pago" wizardCaption="Nom Estado Pago" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="169" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="170" type="Simple" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" size="10" pageSizes="1;5;10;25;50" PathID="peticiones_estados_pagosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="150" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="151" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellidos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="152" conditionType="Parameter" useIsNull="False" field="rut" parameterSource="s_rut" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="153" conditionType="Parameter" useIsNull="False" field="peticiones.estado_pago_id" parameterSource="s_estado_pago_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="4"/>
				<TableParameter id="154" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="5"/>
				<TableParameter id="155" conditionType="Parameter" useIsNull="False" field="peticiones.procedencia_id" parameterSource="s_procedencia_id" dataType="Integer" logicOperator="Or" searchConditionType="Equal" parameterType="URL" orderNumber="6" defaultValue="GetUserProcedenciaID()" leftBrackets="1"/>
				<TableParameter id="177" conditionType="Expression" useIsNull="False" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="&quot; . CCGetGroupID() . &quot; &gt; 4" orderNumber="8" rightBrackets="1"/>
				<TableParameter id="172" conditionType="Parameter" useIsNull="False" field="peticiones.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="peticion_id" orderNumber="7"/>
				<TableParameter id="180" conditionType="Parameter" useIsNull="False" field="peticiones.paciente_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="paciente_id" orderNumber="9"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="120" tableName="peticiones" posWidth="163" posHeight="270" posLeft="10" posTop="10"/>
				<JoinTable id="122" tableName="estados_pagos" posWidth="100" posHeight="100" posLeft="228" posTop="328"/>
				<JoinTable id="124" tableName="pacientes" posWidth="216" posHeight="250" posLeft="293" posTop="10"/>
				<JoinTable id="128" tableName="previsiones" posWidth="100" posHeight="100" posLeft="454" posTop="315"/>
				<JoinTable id="130" tableName="procedencias" posWidth="100" posHeight="100" posLeft="555" posTop="178"/>
				<JoinTable id="132" tableName="usuarios" posWidth="100" posHeight="100" posLeft="27" posTop="435"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="134" fieldLeft="peticiones.estado_pago_id" fieldRight="estados_pagos.estado_pago_id" tableLeft="peticiones" tableRight="estados_pagos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="135" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="136" fieldLeft="peticiones.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="peticiones" tableRight="previsiones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="137" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="138" fieldLeft="peticiones.usuario_id" fieldRight="usuarios.usuario_id" tableLeft="peticiones" tableRight="usuarios" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="121" tableName="peticiones" fieldName="peticiones.*"/>
				<Field id="123" tableName="estados_pagos" fieldName="nom_estado_pago"/>
				<Field id="125" tableName="pacientes" fieldName="rut"/>
				<Field id="126" tableName="pacientes" fieldName="nombres"/>
				<Field id="127" tableName="pacientes" fieldName="apellidos"/>
				<Field id="129" tableName="previsiones" fieldName="nom_prevision"/>
				<Field id="131" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="133" tableName="usuarios" fieldName="nom_usuario"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<IncludePage id="178" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="detalle_pago_peticiones_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="detalle_pago_peticiones.php" comment="//" codePage="utf-8" forShow="True" url="detalle_pago_peticiones.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="102" groupID="4"/>
		<Group id="103" groupID="5"/>
		<Group id="104" groupID="6"/>
		<Group id="105" groupID="7"/>
		<Group id="106" groupID="8"/>
		<Group id="107" groupID="9"/>
		<Group id="108" groupID="10"/>
		<Group id="109" groupID="11"/>
		<Group id="110" groupID="12"/>
		<Group id="111" groupID="13"/>
		<Group id="112" groupID="14"/>
		<Group id="113" groupID="15"/>
		<Group id="114" groupID="16"/>
		<Group id="115" groupID="17"/>
		<Group id="116" groupID="18"/>
		<Group id="117" groupID="19"/>
		<Group id="118" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="192"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
