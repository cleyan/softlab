<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="True" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="pacientes" dataSource="pacientes" errorSummator="Error" wizardCaption="Agregar/Editar Pacientes " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="listPacientes.ccp" PathID="pacientes">
			<Components>
				<TextBox id="9" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="rut" fieldSource="rut" required="False" caption="Rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" unique="True" visible="Yes" PathID="pacientesrut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="ficha" fieldSource="ficha" required="False" caption="Ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" unique="True" visible="Yes" PathID="pacientesficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="13" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nombres" fieldSource="nombres" caption="Nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="pacientesnombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="apellidos" fieldSource="apellidos" caption="Apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" required="True" visible="Yes" PathID="pacientesapellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="direccion" fieldSource="direccion" required="False" caption="Direccion" wizardCaption="Direccion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientesdireccion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="fono" fieldSource="fono" required="False" caption="Fono" wizardCaption="Fono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientesfono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="celular" fieldSource="celular" required="False" caption="Celular" wizardCaption="Celular" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientescelular">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="fax" fieldSource="fax" required="False" caption="Fax" wizardCaption="Fax" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientesfax">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="email" fieldSource="email" required="False" caption="Email" wizardCaption="Email" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$" visible="Yes" PathID="pacientesemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="comuna" fieldSource="comuna" required="False" caption="Comuna" wizardCaption="Comuna" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientescomuna">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="22" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="ciudad" fieldSource="ciudad" required="False" caption="Ciudad" wizardCaption="Ciudad" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientesciudad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="24" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="pais" fieldSource="pais" required="False" caption="Pais" wizardCaption="Pais" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="pacientespais">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha_nacimiento" fieldSource="fecha_nacimiento" caption="Fecha de Nacimiento" wizardCaption="Fecha Nacimiento" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" required="True" visible="Yes" PathID="pacientesfecha_nacimiento">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="38"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="edad_calc" wizardTheme="Inline" wizardThemeType="File" visible="Yes" PathID="pacientesedad_calc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="edad" wizardTheme="Inline" wizardThemeType="File" fieldSource="edad" visible="Yes" PathID="pacientesedad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="sexo_id" fieldSource="sexo_id" caption="Sexo" wizardCaption="Sexo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="sexos" boundColumn="sexo_id" textColumn="nom_sexo" required="True" visible="Yes" PathID="pacientessexo_id">
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
				<ListBox id="12" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_id" fieldSource="prevision_id" caption="Prevision" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" required="True" visible="Yes" PathID="pacientesprevision_id">
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
				<FileUpload id="26" fieldSourceType="DBColumn" allowedFileMasks="*.jpg;*.gif" fileSizeLimit="100000" dataType="Text" tempFileFolder="TEMP" name="path_foto" wizardTheme="Inline" wizardThemeType="File" caption="Ruta de la fotografía" fieldSource="path_foto" processedFileFolder="fotos" disallowedFileMasks="*.exe;*.zip;*.php;*.htm;*.html" PathID="pacientespath_foto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="pacientesButton_Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="30"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Enviar" PathID="pacientesButton_Update">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="31"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="pacientesButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="6" message="Borrar registro?"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="32"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" PathID="pacientesButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="33"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="39"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="paciente_id" parameterSource="paciente_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
			<SecurityGroups>
				<Group id="48" groupID="12" read="True" insert="True" update="True"/>
				<Group id="49" groupID="13" read="True" insert="True" update="True"/>
				<Group id="50" groupID="14" read="True" insert="True" update="True"/>
				<Group id="51" groupID="15" read="True" insert="True" update="True"/>
				<Group id="52" groupID="16" read="True" insert="True" update="True" delete="True"/>
				<Group id="53" groupID="17" read="True" insert="True" update="True" delete="True"/>
				<Group id="54" groupID="18" read="True" insert="True" update="True" delete="True"/>
				<Group id="55" groupID="20" read="True" insert="True" update="True" delete="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_pacientes.php" comment="//" codePage="utf-8" forShow="True" url="add_pacientes.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_pacientes_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="40" groupID="14"/>
		<Group id="41" groupID="15"/>
		<Group id="42" groupID="16"/>
		<Group id="43" groupID="17"/>
		<Group id="44" groupID="18"/>
		<Group id="45" groupID="19"/>
		<Group id="46" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="47"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
