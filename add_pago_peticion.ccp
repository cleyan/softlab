<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="detalle_pago" dataSource="detalle_pago" errorSummator="Error" wizardCaption="Agregar/Editar Detalle Pago " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_pago_peticion.ccp" activeCollection="UFormElements" activeTableType="detalle_pago" customInsertType="Table" customInsert="detalle_pago" customUpdateType="Table" customUpdate="detalle_pago" PathID="detalle_pago">
			<Components>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="paciente" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="20"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lb_peticion_id" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="25"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="12" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="forma_pago_id" fieldSource="forma_pago_id" caption="Forma de Pago" wizardCaption="Forma Pago Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="formas_pago" boundColumn="forma_pago_id" textColumn="nom_forma_pago" orderBy="nom_forma_pago" required="True" visible="Yes" PathID="detalle_pagoforma_pago_id">
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
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha_documento" fieldSource="fecha_documento" caption="Fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" defaultValue="CurrentDate" visible="Yes" PathID="detalle_pagofecha_documento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_banco" fieldSource="banco_id" required="False" caption="Banco" wizardCaption="Nom Banco" wizardTheme="Inline" wizardThemeType="File" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="bancos" boundColumn="banco_id" textColumn="nom_banco" orderBy="nom_banco" visible="Yes" PathID="detalle_pagonom_banco">
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
				<Hidden id="97" fieldSourceType="CodeExpression" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="user_id" wizardTheme="Inline" wizardThemeType="File" defaultValue="CCGetUserID()" PathID="detalle_pagouser_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_id" fieldSource="prevision_id" required="False" caption="Previsión" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_prevision" visible="Yes" PathID="detalle_pagoprevision_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
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
				<TextBox id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="num_cheque_bono" fieldSource="num_cheque_bono" caption="Nº Documento" wizardCaption="Num Cheque Bono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="detalle_pagonum_cheque_bono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="peticion_id" fieldSource="peticion_id" required="False" caption="Peticion Id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="detalle_pagopeticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="26" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="max_valor" wizardTheme="Inline" wizardThemeType="File" PathID="detalle_pagomax_valor">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="27"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="21" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha_ingreso" wizardTheme="Inline" wizardThemeType="File" fieldSource="fecha_ingreso" defaultValue="CurrentDateTime" format="dd/mm/yyyy HH:nn:ss" DBFormat="yyyy-mm-dd HH:nn:ss" PathID="detalle_pagofecha_ingreso">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="24"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="valor" fieldSource="valor" caption="Valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="detalle_pagovalor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lb_max_valor" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="29"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="detalle_pago_id" fieldSource="detalle_pago_id" required="False" caption="Id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="detalle_pagodetalle_pago_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="max_valor_actual" wizardTheme="Inline" wizardThemeType="File" PathID="detalle_pagomax_valor_actual">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextArea id="36" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="observacion" wizardTheme="Inline" wizardThemeType="File" fieldSource="observacion" visible="Yes" PathID="detalle_pagoobservacion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" returnPage="list_pago_peticion.ccp" PathID="detalle_pagoButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" returnPage="list_pago_peticion.ccp" PathID="detalle_pagoButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" returnPage="list_pago_peticion.ccp" PathID="detalle_pagoButton_Delete">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="6" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="list_pago_peticion.ccp" PathID="detalle_pagoButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="30"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
					</Actions>
				</Event>
				<Event name="AfterDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="33"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="34"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="detalle_pago_id" parameterSource="detalle_pago_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="22" tableName="detalle_pago" posWidth="150" posHeight="204" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="23" tableName="detalle_pago" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="98" field="forma_pago_id" dataType="Integer" parameterType="Control" parameterSource="forma_pago_id"/>
				<CustomParameter id="99" field="fecha_documento" dataType="Date" parameterType="Control" parameterSource="fecha_documento" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss"/>
				<CustomParameter id="100" field="banco_id" dataType="Text" parameterType="Control" parameterSource="nom_banco"/>
				<CustomParameter id="101" field="prevision_id" dataType="Integer" parameterType="Control" parameterSource="prevision_id"/>
				<CustomParameter id="102" field="num_cheque_bono" dataType="Text" parameterType="Control" parameterSource="num_cheque_bono"/>
				<CustomParameter id="103" field="peticion_id" dataType="Integer" parameterType="Control" parameterSource="peticion_id"/>
				<CustomParameter id="105" field="fecha_ingreso" dataType="Date" parameterType="Control" parameterSource="fecha_ingreso" format="dd/mm/yyyy HH:nn:ss" DBFormat="yyyy-mm-dd HH:nn:ss"/>
				<CustomParameter id="106" field="valor" dataType="Integer" parameterType="Control" parameterSource="valor"/>
				<CustomParameter id="107" field="detalle_pago_id" dataType="Integer" parameterType="Control" parameterSource="detalle_pago_id"/>
				<CustomParameter id="109" field="observacion" dataType="Text" parameterType="Control" parameterSource="observacion"/>
				<CustomParameter id="110" field="usuario_id" dataType="Integer" parameterType="Expression" parameterSource="CCGetUserID()"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="111" conditionType="Parameter" useIsNull="False" field="detalle_pago_id" dataType="Integer" parameterType="URL" parameterSource="detalle_pago_id" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="112" field="forma_pago_id" dataType="Integer" parameterType="Control" parameterSource="forma_pago_id"/>
				<CustomParameter id="113" field="fecha_documento" dataType="Date" parameterType="Control" parameterSource="fecha_documento" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss"/>
				<CustomParameter id="114" field="banco_id" dataType="Text" parameterType="Control" parameterSource="nom_banco"/>
				<CustomParameter id="115" field="prevision_id" dataType="Integer" parameterType="Control" parameterSource="prevision_id"/>
				<CustomParameter id="116" field="num_cheque_bono" dataType="Text" parameterType="Control" parameterSource="num_cheque_bono"/>
				<CustomParameter id="117" field="peticion_id" dataType="Integer" parameterType="Control" parameterSource="peticion_id"/>
				<CustomParameter id="119" field="fecha_ingreso" dataType="Date" parameterType="Control" parameterSource="fecha_ingreso" format="dd/mm/yyyy HH:nn:ss" DBFormat="yyyy-mm-dd HH:nn:ss"/>
				<CustomParameter id="120" field="valor" dataType="Integer" parameterType="Control" parameterSource="valor"/>
				<CustomParameter id="121" field="detalle_pago_id" dataType="Integer" parameterType="Control" parameterSource="detalle_pago_id"/>
				<CustomParameter id="123" field="observacion" dataType="Text" parameterType="Control" parameterSource="observacion"/>
				<CustomParameter id="124" field="usuario_id" dataType="Integer" parameterType="Expression" parameterSource="CCGetUserID()"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="37" secured="False" sourceType="Table" returnValueType="Number" connection="Datos" dataSource="detalle_pago, formas_pago, usuarios, bancos, previsiones" name="detalle_pago_formas_pago" wizardCaption="Lista de Detalle Pago, Formas Pago, Usuarios, Bancos, Previsiones " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="detalle_pago_formas_pago">
			<Components>
				<Sorter id="80" visible="True" name="Sorter_fecha_ingreso" column="fecha_ingreso" wizardCaption="Fecha Ingreso" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha_ingreso" PathID="detalle_pago_formas_pagoSorter_fecha_ingreso">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="81" visible="True" name="Sorter_nom_forma_pago" column="nom_forma_pago" wizardCaption="Nom Forma Pago" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_forma_pago" PathID="detalle_pago_formas_pagoSorter_nom_forma_pago">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="82" visible="True" name="Sorter_nom_banco" column="nom_banco" wizardCaption="Nom Banco" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_banco" PathID="detalle_pago_formas_pagoSorter_nom_banco">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="83" visible="True" name="Sorter_nom_prevision" column="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_prevision" PathID="detalle_pago_formas_pagoSorter_nom_prevision">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="84" visible="True" name="Sorter_fecha_documento" column="fecha_documento" wizardCaption="Fecha Documento" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha_documento" PathID="detalle_pago_formas_pagoSorter_fecha_documento">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="85" visible="True" name="Sorter_num_cheque_bono" column="num_cheque_bono" wizardCaption="Num Cheque Bono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="num_cheque_bono" PathID="detalle_pago_formas_pagoSorter_num_cheque_bono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="86" visible="True" name="Sorter_valor" column="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="valor" PathID="detalle_pago_formas_pagoSorter_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="87" visible="True" name="Sorter_nom_usuario" column="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_usuario" PathID="detalle_pago_formas_pagoSorter_nom_usuario">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="88" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_ingreso" fieldSource="fecha_ingreso" wizardCaption="Fecha Ingreso" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_forma_pago" fieldSource="nom_forma_pago" wizardCaption="Nom Forma Pago" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="90" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_banco" fieldSource="nom_banco" wizardCaption="Nom Banco" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_prevision" fieldSource="nom_prevision" wizardCaption="Nom Prevision" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_documento" fieldSource="fecha_documento" wizardCaption="Fecha Documento" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="num_cheque_bono" fieldSource="num_cheque_bono" wizardCaption="Num Cheque Bono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="94" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="valor" fieldSource="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" format="$0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="95" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_usuario" fieldSource="nom_usuario" wizardCaption="Nom Usuario" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="detalle_pago.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="peticion_id" orderNumber="1" defaultValue="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="66" tableName="detalle_pago" posWidth="100" posHeight="242" posLeft="10" posTop="10"/>
				<JoinTable id="68" tableName="formas_pago" posWidth="100" posHeight="100" posLeft="128" posTop="0"/>
				<JoinTable id="70" tableName="usuarios" posWidth="100" posHeight="100" posLeft="384" posTop="198"/>
				<JoinTable id="72" tableName="bancos" posWidth="100" posHeight="100" posLeft="340" posTop="10"/>
				<JoinTable id="74" tableName="previsiones" posWidth="100" posHeight="100" posLeft="450" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="76" fieldLeft="detalle_pago.forma_pago_id" fieldRight="formas_pago.forma_pago_id" tableLeft="detalle_pago" tableRight="formas_pago" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="77" fieldLeft="detalle_pago.usuario_id" fieldRight="usuarios.usuario_id" tableLeft="detalle_pago" tableRight="usuarios" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="78" fieldLeft="detalle_pago.banco_id" fieldRight="bancos.banco_id" tableLeft="detalle_pago" tableRight="bancos" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="79" fieldLeft="detalle_pago.prevision_id" fieldRight="previsiones.prevision_id" tableLeft="detalle_pago" tableRight="previsiones" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="67" tableName="detalle_pago" fieldName="detalle_pago.*"/>
				<Field id="69" tableName="formas_pago" fieldName="nom_forma_pago"/>
				<Field id="71" tableName="usuarios" fieldName="nom_usuario"/>
				<Field id="73" tableName="bancos" fieldName="nom_banco"/>
				<Field id="75" tableName="previsiones" fieldName="nom_prevision"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<IncludePage id="35" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_pago_peticion.php" comment="//" codePage="utf-8" forShow="True" url="add_pago_peticion.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_pago_peticion_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="125"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
